#!/bin/bash

function JPackage {
echo -e "\\033[1;34m" Removing all zip files from folder;
rm *.zip;

#house cleaning
rmdir -rf packages;

#zip up the source files
zip -r com_allicons.1.1.1.zip com_allicons -x@exclude.lst;
zip -r mod_allicons.1.0.1.zip mod_allicons -x@exclude.lst;

#make the packages directory
mkdir packages;

#move the files
mv com_allicons.1.1.1.zip packages/com_allicons.1.1.1.zip;
mv mod_allicons.1.0.1.zip packages/mod_allicons.1.0.1.zip;

#make the final pkg file
zip -r pkg_allicons.1.1.2.zip packages pkg_allicons.xml -x@exclude.lst;

echo "zip all icons done";
}

JPackage