#!/bin/bash

on_error(){
        echo "Error found in: $(caller)" >&2
}

yum install -y centos-release-scl

yum install -y bzip2

yum install -y devtoolset-8-gcc devtoolset-8-gcc-c++ devtoolset-8-binutils

yum install -y python3

echo "source /opt/rh/devtoolset-8/enable" >> /etc/profile

source /etc/profile

yum install -y bison

cd /opt/package

wget https://ftp.gnu.org/gnu/make/make-4.3.tar.gz

tar -xzvf make-4.3.tar.gz

cd make-4.3/

./configure --prefix=/usr/local/make --disable-dependency-tracking

make

make install

cd /usr/bin/

mv make make.bak

ln -s /usr/local/make/bin/make /usr/bin/make

cd /opt/package

wget https://ftp.gnu.org/gnu/glibc/glibc-2.30.tar.gz

tar -xzvf glibc-2.30.tar.gz

cd glibc-2.30

mkdir build && cd build

../configure --prefix=/usr --disable-profile --enable-add-ons --with-headers=/usr/include --with-binutils=/usr/bin

make

sed -i '128s/.*/\&\& \$name ne "nss_test1" \&\& \$name ne "nss_test2" \&\& \$name ne "nss_nis" \&\& \$name ne "nss_nisplus" \&\& \$name ne "libgcc_s"\) {/' /opt/package/glibc-2.30/scripts/test-installation.pl

make install

curl https://raw.githubusercontent.com/creationix/nvm/master/install.sh | bash

source ~/.bashrc

cd /opt/package

GCC_VERSION=9.4.0

wget https://ftp.gnu.org/gnu/gcc/gcc-${GCC_VERSION}/gcc-${GCC_VERSION}.tar.gz

tar xzvf gcc-${GCC_VERSION}.tar.gz

mkdir obj.gcc-${GCC_VERSION}

cd gcc-${GCC_VERSION}

./contrib/download_prerequisites

cd ../obj.gcc-${GCC_VERSION}

../gcc-${GCC_VERSION}/configure --disable-multilib --enable-languages=c,c++

make -j $(nproc)

make install

cd /usr/local/lib64/

cp libstdc++.so.6.0.28 /usr/lib64/

cd /usr/lib64/

mv libstdc++.so.6 libstdc++.so.6.BAK

ln -sf libstdc++.so.6.0.28 libstdc++.so.6

strings /usr/lib64/libstdc++.so.6 | grep GLIBCXX

nvm install 18.0.0

usermod -aG wheel deployer
