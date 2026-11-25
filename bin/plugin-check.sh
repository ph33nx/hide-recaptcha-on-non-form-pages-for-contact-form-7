#!/usr/bin/env bash
# Runs Plugin Check on the built zip, under its wp.org slug. The command exits 0 whatever it finds, so its output is the gate.
set -euo pipefail
cd "$(dirname "$0")/.."
bin/build-zip.sh > /dev/null
out=$(npx wp-env run cli bash -c 'rm -rf /tmp/pc && mkdir /tmp/pc && cp -r wp-content/plugins/hide-recaptcha-on-non-form-pages-for-contact-form-7/build/hide-recaptcha-on-non-form-pages-for-contact-form-7 /tmp/pc/ && wp plugin check /tmp/pc/hide-recaptcha-on-non-form-pages-for-contact-form-7 --severity=5 --format=json')
echo "$out"
if grep -q '"type":"ERROR"' <<< "$out"; then
	echo "Plugin Check found errors." >&2
	exit 1
fi
