# Async PHP playground

Purpose of this repository is to demonstrate how to use amphp/amp to run multiple child processes in parallel.

As bonus, it shows how to pass data from child processes to parent.

### Usage
Just run `php run-multiple-processes.php`

### Expected results

It runs 10 times `script.php` that has `sleep(5)` inside and we expect all of this to finish within 5-6 seconds.

```
Array
(
    [0] => stdClass Object
        (
            [process_index] => 1
            [rand] => 9
        )

    [1] => stdClass Object
        (
            [process_index] => 2
            [rand] => 2
        )

    [2] => stdClass Object
        (
            [process_index] => 3
            [rand] => 4
        )

    [3] => stdClass Object
        (
            [process_index] => 4
            [rand] => 7
        )

    [4] => stdClass Object
        (
            [process_index] => 5
            [rand] => 3
        )

    [5] => stdClass Object
        (
            [process_index] => 6
            [rand] => 9
        )

    [6] => stdClass Object
        (
            [process_index] => 7
            [rand] => 9
        )

    [7] => stdClass Object
        (
            [process_index] => 8
            [rand] => 8
        )

    [8] => stdClass Object
        (
            [process_index] => 9
            [rand] => 6
        )

    [9] => stdClass Object
        (
            [process_index] => 10
            [rand] => 9
        )

)

Script took 5.5493841171265 seconds to run
```