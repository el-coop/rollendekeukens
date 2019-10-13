<?php


namespace App\Models\Traits;


use Cache;
use Illuminate\Support\Str;

trait Cacheable {
    public function scopeGetCached($query) {
        try {
            $key = Str::replaceArray('?', $query->getBindings(), $query->toSql());
            return Cache::tags([static::class])->rememberForever($key, function () use ($query) {
                return $query->get();
            });
        } catch (\Exception $exception) {
            return $query->get();
        }
    }
    
    public function scopeFirstCached($query) {
        try {
            $key = Str::replaceArray('?', $query->getBindings(), $query->toSql());
            return Cache::tags([static::class])->rememberForever("{$key}_first", function () use ($query) {
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
