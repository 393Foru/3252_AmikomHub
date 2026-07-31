
param(
    [string]$theme
)

$themes = @{
    "orange" = @{ primary = "orange"; secondary = "rose" }
    "blue"   = @{ primary = "blue"; secondary = "cyan" }
    "teal"   = @{ primary = "teal"; secondary = "emerald" }
    "indigo" = @{ primary = "indigo"; secondary = "purple" }
}

if (-not $themes.ContainsKey($theme)) {
    Write-Host "Unknown theme"
    exit 1
}

$target = $themes[$theme]
$files = @(
    "resources\views\welcome.blade.php",
    "resources\views\layouts\app.blade.php",
    "resources\views\vendor\pagination\tailwind.blade.php"
)

foreach ($file in $files) {
    if (Test-Path $file) {
        $content = Get-Content $file -Raw
        $content = $content -replace "\b(indigo|orange|blue|teal|violet)-(50|100|200|300|400|500|600|700|800|900)\b", "$($target.primary)-`$2"
        $content = $content -replace "\b(purple|rose|cyan|emerald|fuchsia)-(50|100|200|300|400|500|600|700|800|900)\b", "$($target.secondary)-`$2"
        Set-Content -Path $file -Value $content
        Write-Host "Updated $file"
    }
}
