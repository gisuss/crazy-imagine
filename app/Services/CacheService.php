<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;

class CacheService
{
    // Tiempo de vida del caché en minutos
    const DEFAULT_CACHE_TTL = 30;

    /**
     * Obtener datos del caché o ejecutar el callback y guardar el resultado
     */
    public static function remember(string $key, callable $callback, ?int $minutes = null)
    {
        $minutes = $minutes ?? self::DEFAULT_CACHE_TTL;
        return Cache::remember($key, now()->addMinutes($minutes), $callback);
    }

    /**
     * Limpiar un elemento específico del caché
     */
    public static function forget(string $key): bool
    {
        return Cache::forget($key);
    }

    /**
     * Limpiar todo el caché de la aplicación
     */
    public static function clearAll(): bool
    {
        return Cache::flush();
    }

    /**
     * Obtener una clave única para el caché basada en el modelo y sus relaciones
     */
    public static function getCacheKey(string $model, array $relations = [], array $filters = []): string
    {
        $key = "{$model}_" . implode('_', $relations);
        
        if (!empty($filters)) {
            $key .= '_' . md5(serialize($filters));
        }
        
        return $key;
    }
}
