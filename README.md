## READ ME
A simple form to verify an FCA number.

The FCA number must be alphanumeric nd between 4 and 20 characters. 

If the FCA number is valid a success message is returned. Otherwise, an appropriate error message is given.

## Basic Setup
cd into laravel-set up and run 
``` docker-compose up -d ```

Update the ``FCA_KEY`` and ``FCA_EMAIL`` values in the .env file





## Tests
Run 
```php artisan test``` to run the test suit. 

## Further work
###Caching
Caching can be added to prevent the FCA API form getting called to many times, this can also help with preventing
throttling of the API. 

As only a simple cache is needed then it is recommended that Memcached is used. 

This can be easily put into the ```FormController::verifyFca``` method with something along the lines of 

```

if (Cache::has($request->fcaNumber)) {
    $fcaResult = Cache::get($cacheKey);
}
```

to set the cache
```
Cache::put($request->fcaNumber, $fcaResult, $ttl);
```

###Credentials
Move the  ``FCA_KEY`` and ``FCA_EMAIL`` values into Amazon KMS or something similar.
This is to improve security and make sure nothing is added into git accidentally. 

###Git
As this is just a demo the ``.env`` is not in the git ignore file. 
However, this should be the case. The ``.env`` file should be in the ``.gitignore`` and a .env.example
file should be used with empty values and then manually copied over to ``.env``
