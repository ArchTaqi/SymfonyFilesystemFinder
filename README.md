# Symfony - Filesystem, Finder and The Lock Components

PHP has already built-in functions for working with files, but the native function tries to replicate the commands we know from the console but not their functionality anymore. 
And if he encounters an error, the only thing we usually get is warning:
```
$ php -a
php > mkdir('tmp/test');
PHP Warning: mkdir(): No such file or directory in php shell code on line 1
php > copy('./foo.log', './tmp/test/');
PHP Warning: copy(): The second argument to copy() function cannot be a directory in php shell code on line 1

vs

$ mkdir -p tmp/test
$ cp foo.log ./tmp/test/
```



## Main concepts

### Filesystem
- when saving a file, it will take care of the folder
- can lock files and prevent incomplete or invalid data on the disk
- converts errors into exceptions that we can handle

### Finder
- finds us files and folders
- they can filter by name, type, date of creation, and size
- has a couple of nice tricks for different edge cases

### The Lock Component

- solved file locking - typically if you can overlap with crones, when two processes process the same data or rewrite each other. For these cases, it is good to create a file lock:


## Conclusion


## Code