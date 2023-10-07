#!/bin/bash

echo 'Cloning Web YouTube Downloader...'

rm -rf youtube-downloader

git clone https://github.com/Athlon1600/youtube-downloader

rm -f ./composer.phar

curl -sS https://getcomposer.org/installer | php

cd ./youtube-downloader/

rm -rf ./.git

php ../composer.phar install -n --no-dev

dos2unix *.html
dos2unix *.php

cp ../index.html ./public/
cp ../download.php ./public/
cp ../video_info.php ./public/

echo "Building Web YouTube Downloader has been done."
