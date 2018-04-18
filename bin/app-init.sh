#!/bin/bash
#初始化脚本
root_dir=$(cd "$(dirname "$0")"; cd ..; pwd)

# 缓存目录初始化
mkdir -p $root_dir/storage/{app,framework,logs}/
mkdir -p $root_dir/storage/framework/cache/data
mkdir -p $root_dir/storage/framework/views
mkdir -p $root_dir/storage/framework/sessions

chmod -R 777 $root_dir/storage/
