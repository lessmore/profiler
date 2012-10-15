# PHP memory usage monitor

Following class is a memory usage monitor for PHP scripts.
It registers memory usage every N low-level tickable statements
executed by the parser after the declare statement.

The result is returned in a fancy graph using GD library.

![Alt text](http://cloud.github.com/downloads/kampaw/profiler/example.png)

## Installation

In console type:

```bash
wget https://github.com/kampaw/profiler/zipball/master -O profiler.zip
mv kampaw-profiler* profiler
chown :www-data profiler
chmod 775 profiler
```
Now class is ready to use.
Direcotory containing profiler files must have read/write/execute access rights.

## Usage

1. Include profiler.php file into your script.
2. Create a profiler object.
3. Declare ticks directive adjusting amount of ticks.
   This step starts monitoring memory usage.
4. Call chart method to stop monitoring and display the result.

```php
require('profiler.php');

$profiler = new profiler;
declare(ticks = 1);

// monitor started
// insert your code here

$profiler->chart();
```

You can see the example usage in example.php file.

## Adjusting ticks directive

You have to decide how often monitor will gather data for profiling.

Setting ticks value to 1 means that monitor will register memory usage
after every statement in your script.
However remember that if your script is very complex setting this value too low 
will heavily affect the execution time and you should increase it.

Average setting is about 10 ticks for scripts with medium complexity.