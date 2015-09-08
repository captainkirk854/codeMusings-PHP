@REM This can be used to source PHP Environment variables in a cmd session.
@REM e.g. 
@REM 	call "D:\Program Files\PHPUNIT\phpOnly_setenv.bat"
@REM Tip
@REM 	o Run it twice in quick succession to ensure correct setting
@REM    o PHP check: > php

@echo off
set BINPHP=D:\Program Files\PHP5
set Path=%Path%;%BINPHP%;

echo [BINPHP] is set to: %BINPHP%
echo [Path] is set to: %Path%