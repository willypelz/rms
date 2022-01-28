#!/bin/bash
set -x;

i=0
cd scripts/conf.d && ls  | while read line
do
    # array[ $i ]="$line"        
    # (( i++ ))
    echo $line
    sed 's+/rms+/html+g' $line > test.conf
    mv test.conf $line
done