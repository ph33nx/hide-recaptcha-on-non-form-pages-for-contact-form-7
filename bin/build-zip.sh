#!/usr/bin/env bash
# Builds build/hide-recaptcha-on-non-form-pages-for-contact-form-7.zip with the files the SVN deploy ships: both read .distignore.
set -euo pipefail
cd "$(dirname "$0")/.."
rm -rf build
mkdir -p build/hide-recaptcha-on-non-form-pages-for-contact-form-7
rsync -a --exclude-from=.distignore ./ build/hide-recaptcha-on-non-form-pages-for-contact-form-7/
(cd build && zip -qr hide-recaptcha-on-non-form-pages-for-contact-form-7.zip hide-recaptcha-on-non-form-pages-for-contact-form-7)
find build/hide-recaptcha-on-non-form-pages-for-contact-form-7 -type f | sort
