#!/bin/sh

# https://stackoverflow.com/a/1638397
# Absolute path to this script, e.g. /home/user/bin/foo.sh
SCRIPT=$(readlink -f "$0")
# Absolute path this script is in, thus /home/user/bin
SCRIPTPATH=$(dirname "$SCRIPT")

cd $SCRIPTPATH/.. \
    && sudo docker-compose -f docker-compose.dev.yml up -d --build --remove-orphans
