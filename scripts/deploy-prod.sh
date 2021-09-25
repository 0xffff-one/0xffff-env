#!/bin/sh

# https://stackoverflow.com/a/1638397
# Absolute path to this script, e.g. /home/user/bin/foo.sh
SCRIPT=$(readlink -f "$0")
# Absolute path this script is in, thus /home/user/bin
SCRIPTPATH=$(dirname "$SCRIPT")

sudo docker pull zgq354/0xffff-flarum:latest \
    && cd $SCRIPTPATH/.. \
    && sudo mkdir -p data/nginx-public \
    && sudo docker run --rm -v $SCRIPTPATH/../data/nginx-public:/nginx-public zgq354/0xffff-flarum:latest rsync -av /wwwroot/public/ /nginx-public/ \
    && sudo docker-compose up -d --build --remove-orphans \
    && sudo docker exec -it 0xffff-app php flarum cache:clear
