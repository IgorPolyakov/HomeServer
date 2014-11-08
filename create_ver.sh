#!/bin/bash

echo "<?php echo \"`git rev-list HEAD --count`\";" > version.php
# echo $(git rev-list HEAD --count) >> version.php
# echo "\";" >> version.php

