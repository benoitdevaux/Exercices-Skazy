@ECHO OFF
setlocal DISABLEDELAYEDEXPANSION
SET BIN_TARGET=%~dp0/../irstea/phpstan-config/bin/phpstan-watch
bash "%BIN_TARGET%" %*
