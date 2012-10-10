# PHP memory usage monitor

Following class is a memory usage monitor for PHP scripts.
It registers memory usage every N low-level tickable statements
executed by the parser within the declare block.

The result is returned in a fancy graph using GD library.

![Alt text](https://raw.github.com/kampaw/profiler/master/example.png)

## Usage

1. Include profiler.php file into your script.
2. Create a profiler object.
3. Declare ticks directive adjusting amount of ticks.
   This step starts monitoring memory usage.
4. Call chart method to stop monitoring and display the result.

```php
require('profiler.php');

$profiler = new profiler;
declare(ticks = 30000);

// monitor started
// insert your code here

$profiler->chart();
```


You can see the example usage in example.php file.

## Adjusting tick directive

You have to decide how often monitor will gather data for profiling.
Average setting is about 30000 ticks for scripts with medium execution time.
You have to remember that if you set the value too low it will heavily
affect the execution time.