# Play with psysh

```
./psysh

require_once __DIR__.'/autoload.php'
App::bootstrap()
\Models\Question::all()->toArray()
\Models\Question::first()->toArray()
\Models\Question::create(['title' => 'q 3'])


```