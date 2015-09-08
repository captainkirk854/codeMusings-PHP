@REM Install adapted from instructions @ https://phpunit.de/manual/current/en/installation.html
@REM Usage requires PHP to be installed and PATH'd
@REM % and * are escaped - phpunit.cmd format is: @php "<PATH>\phpunit.phar" %* 

echo @php "%~dp0phpunit.phar" %%^* > phpunit.cmd
exit