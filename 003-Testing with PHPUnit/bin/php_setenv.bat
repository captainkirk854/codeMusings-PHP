@REM This can be used to source PHP Environment variables in a cmd session.
@REM e.g. 
@REM 	call "D:\Program Files\PHPUNIT\php_setenv.bat"
@REM Tip
@REM 	o Run it twice in quick succession to ensure correct setting
@REM    o PHP check: > php
@REM    o PHPUNIT check:
@REM    	o > phpunit --version
@REM		o > phpunit --check-version

@echo off
set BINPHP=D:\Program Files\PHP5
set BINPHPUNIT=D:\Program Files\PHPUNIT\bin
set Path=%Path%;%BINPHP%;%BINPHPUNIT%;

echo [BINPHP] is set to: %BINPHP%
echo [BINPHPUNIT] is set to: %BINPHPUNIT%
echo [Path] is set to: %Path%