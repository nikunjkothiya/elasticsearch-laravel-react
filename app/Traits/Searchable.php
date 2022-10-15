<?php

namespace App\Traits;

use Elastic\Elasticsearch\ClientBuilder;
use Illuminate\Support\Facades\Config;

trait Searchable
{
    /** @var \Elasticsearch\Client */
    private static $elastic_client;

    /**
     * Get model index in Elasticsearch
     *
     * @return string
     */
    abstract public static function getElasticIndexName();

    public static function bootSearchable()
    {
        /** Subscribe to created event and add new document to Elasticsearch */
        static::created(function ($model) {
            static::getElasticClient()->index([
                'index' => static::getElasticIndexName(),
                'id'    => $model->id,
                'body'  => $model->toSearchableArray(),
            ]);
        });

        /** Subscribe to update event and update document to Elasticsearch */
        static::updated(function ($model) {
            static::getElasticClient()->update([
                'index' => static::getElasticIndexName(),
                'id'    => $model->id,
                'body'  => [
                    'doc' => $model->toSearchableArray(),
                ],
            ]);
        });

        /** Subscribe to delete event and delete document from Elasticsearch */
        static::deleted(function ($model) {
            static::getElasticClient()->delete([
                'index' => static::getElasticIndexName(),
                'id'    => $model->id,
            ]);
        });
    }

    /**
     * Search document by query
     * 
     * @param array $query
     *                    
     * @return array
     */
    public static function search(array $query)
    {
        return static::getElasticClient()->search([
            'index' => static::getElasticIndexName(),
            'body'  => $query,
        ]);
    }

    /**
     * Get model searchable data
     *
     * @return array
     */
    public function toSearchableArray(): array
    {
        return $this->toArray();
    }

    /**
     * Get Elasticsearch Client
     *
     * @return \Elasticsearch\Client
     */
    private static function getElasticClient()
    {
        if (!static::$elastic_client) {
            return static::$elastic_client = ClientBuilder::fromConfig(
                Config::get('elasticsearch')
            );
        }

        return static::$elastic_client;
    }
}
