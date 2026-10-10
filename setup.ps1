$ErrorActionPreference = 'Stop'
Set-Location $PSScriptRoot

function Require-Command([string] $Name) {
    if (-not (Get-Command $Name -ErrorAction SilentlyContinue)) {
        throw "Missing required command: $Name. Install it first and re-run this script."
    }
}
function Run-Checked([string] $Exe, [string[]] $Arguments) {
    Write-Host ("`n> " + $Exe + " " + ($Arguments -join " ")) -ForegroundColor Cyan
    & $Exe @Arguments
    if ($LASTEXITCODE -ne 0) { throw "$Exe failed (exit code $LASTEXITCODE)" }
}

Require-Command 'php'
Require-Command 'composer'
Require-Command 'node'
Require-Command 'npm'
if (-not (php -m | Select-String -Pattern '^pdo_sqlite$' -Quiet)) {
    throw 'The pdo_sqlite PHP extension is missing. Enable it in your PHP installation.'
}
if (-not (Test-Path .env)) { Copy-Item .env.example .env }
if (-not (Test-Path database/database.sqlite)) { New-Item -ItemType File -Path database/database.sqlite | Out-Null }
Run-Checked 'composer' @('install', '--no-interaction')
if (-not (Select-String -Path .env -Pattern '^APP_KEY=base64:' -Quiet)) {
    Run-Checked 'php' @('artisan', 'key:generate', '--force')
}
Run-Checked 'npm' @('install')
Run-Checked 'npm' @('run', 'build')
Run-Checked 'php' @('artisan', 'migrate', '--force')
Run-Checked 'php' @('artisan', 'test')
Write-Host "`nSetup and tests completed. Start with: php artisan serve" -ForegroundColor Green
