<?php

namespace App\Traits;

use App\Services\CacheService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

/**
 * @method static \Illuminate\Database\Query\Builder withCachedRelations(array $relations = [])
 * @method static \Illuminate\Database\Query\Builder withCachedCount(array $relations = [])
 */
trait HasCache
{
    /**
     * Inicializar el trait
     */
    public static function bootHasCache()
    {
        // Limpiar caché cuando se actualiza o elimina un modelo
        static::saved(function ($model) {
            $model->clearCache();
        });

        static::deleted(function ($model) {
            $model->clearCache();
        });
    }

    /**
     * Obtener el nombre de la clave de caché para este modelo
     */
    protected function getCacheKey(string $suffix = ''): string
    {
        $key = get_class($this) . ':' . $this->getKey();
        
        if ($suffix) {
            $key .= ':' . $suffix;
        }
        
        return $key;
    }

    /**
     * Limpiar el caché de este modelo
     */
    public function clearCache(): void
    {
        // Limpiar caché de este modelo
        CacheService::forget($this->getCacheKey());
        
        // Limpiar caché de relaciones
        foreach ($this->getRelations() as $relation => $items) {
            CacheService::forget($this->getCacheKey($relation));
        }
    }

    /**
     * Obtener un atributo del modelo o de la caché
     */
    public function getCachedAttribute(string $key, callable $callback, ?int $minutes = null)
    {
        $cacheKey = $this->getCacheKey($key);
        
        return CacheService::remember(
            $cacheKey,
            $callback,
            $minutes
        );
    }

    /**
     * Scope para cargar relaciones con caché
     */
    public function scopeWithCachedRelations(Builder $query, array $relations = []): Builder
    {
        foreach ($relations as $relation) {
            $query->with([
                $relation => function ($query) use ($relation) {
                    $cacheKey = $this->getCacheKey($relation);
                    return CacheService::remember(
                        $cacheKey,
                        fn() => $query->getResults(),
                        CacheService::DEFAULT_CACHE_TTL
                    );
                }
            ]);
        }

        return $query;
    }

    /**
     * Scope para cargar recuentos con caché
     */
    public function scopeWithCachedCount(Builder $query, array $relations = []): Builder
    {
        foreach ($relations as $relation) {
            $cacheKey = $this->getCacheKey("count_{$relation}");
            
            $query->withCount([
                $relation => function ($query) use ($cacheKey) {
                    return CacheService::remember(
                        $cacheKey,
                        fn() => $query->getQuery(),
                        CacheService::DEFAULT_CACHE_TTL
                    );
                }
            ]);
        }

        return $query;
    }
}
