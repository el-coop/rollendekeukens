<?php


namespace App\Models\Traits;


use Cache;

trait Cacheable {
    public function scopeGetCached($query) {
        try {
            return Cache::tags([static::class])->rememberForever($query->toSql(), function () use ($query) {
                return $query->get();
            });
        } catch (\Exception $exception) {
            return $query->get();
        }
    }
    
    public function scopeFirstCached($query) {
        try {
            return Cache::tags([static::class])->rememberForever("{$query->toSql()}_first", function () use ($query) {
                return $query->first();
            });
        } catch (\Exception $exception) {
            return $query->first();
        }
    }
    
    static public function flushCache() {
        try {
            Cache::tags([static::class])->flush();
        } catch (\Exception $exception) {
        }
    }
}
