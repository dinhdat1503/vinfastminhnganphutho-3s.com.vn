# VinFast Car Image Downloader
# Downloads official car images from VinFast website pages

$headers = @{
    "User-Agent" = "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36"
    "Accept" = "text/html,application/xhtml+xml,application/xml;q=0.9,image/avif,image/webp,image/apng,*/*;q=0.8"
    "Accept-Language" = "vi-VN,vi;q=0.9,en-US;q=0.8,en;q=0.7"
    "Referer" = "https://vinfastauto.com/"
}

$basePath = Split-Path -Parent $MyInvocation.MyCommand.Path

# Car model URLs on the official site
$carPages = @(
    @{ Name = "vf3"; Url = "https://vinfastauto.com/vn_vi/vf-3" },
    @{ Name = "vf5"; Url = "https://vinfastauto.com/vn_vi/vf-5-plus" },
    @{ Name = "vf6"; Url = "https://vinfastauto.com/vn_vi/vf-6" },
    @{ Name = "vf7"; Url = "https://vinfastauto.com/vn_vi/vf-7" },
    @{ Name = "vf8"; Url = "https://vinfastauto.com/vn_vi/vf-8" },
    @{ Name = "vf9"; Url = "https://vinfastauto.com/vn_vi/vf-9" }
)

foreach ($car in $carPages) {
    $folder = Join-Path $basePath $car.Name
    if (-Not (Test-Path $folder)) {
        New-Item -ItemType Directory -Path $folder -Force | Out-Null
    }

    Write-Host "=== Fetching page: $($car.Url) ===" -ForegroundColor Cyan
    try {
        $response = Invoke-WebRequest -Uri $car.Url -Headers $headers -TimeoutSec 30
        $html = $response.Content

        # Extract all image URLs from the page
        $imgMatches = [regex]::Matches($html, '(?:src|data-src|data-image|content)=["\''](https?://[^"'']+?\.(?:png|jpg|jpeg|webp|svg))["\''?]', 'IgnoreCase')

        $imageUrls = @()
        foreach ($m in $imgMatches) {
            $url = $m.Groups[1].Value
            # Filter for car-related images (skip icons, logos, small UI elements)
            if ($url -match "static-cms|vinfastauto|vinfast" -and $url -notmatch "icon|logo|favicon|flag|arrow|btn|button|close") {
                $imageUrls += $url
            }
        }

        # Also extract background-image URLs
        $bgMatches = [regex]::Matches($html, 'background[-\s]*image\s*:\s*url\(["\''](https?://[^"'']+?\.(?:png|jpg|jpeg|webp))["\'']\)', 'IgnoreCase')
        foreach ($m in $bgMatches) {
            $url = $m.Groups[1].Value
            if ($url -match "static-cms|vinfastauto|vinfast") {
                $imageUrls += $url
            }
        }

        # Remove duplicates
        $imageUrls = $imageUrls | Select-Object -Unique

        Write-Host "  Found $($imageUrls.Count) image URLs" -ForegroundColor Green

        $i = 0
        foreach ($imgUrl in $imageUrls) {
            $i++
            $ext = [System.IO.Path]::GetExtension(($imgUrl -split '\?')[0])
            if (-not $ext -or $ext.Length -gt 6) { $ext = ".webp" }
            $fileName = "$($car.Name)_$i$ext"
            $filePath = Join-Path $folder $fileName

            Write-Host "  Downloading: $imgUrl" -ForegroundColor Yellow
            try {
                Invoke-WebRequest -Uri $imgUrl -OutFile $filePath -Headers @{
                    "User-Agent" = $headers["User-Agent"]
                    "Referer" = $car.Url
                } -TimeoutSec 15
                Write-Host "  -> Saved: $filePath" -ForegroundColor Green
            } catch {
                Write-Host "  -> FAILED: $($_.Exception.Message)" -ForegroundColor Red
            }
        }

        # Write URL list to file
        $urlFile = Join-Path $folder "urls.txt"
        $imageUrls | Out-File -FilePath $urlFile -Encoding UTF8
        Write-Host "  URL list saved to: $urlFile" -ForegroundColor Cyan

    } catch {
        Write-Host "  FAILED to fetch page: $($_.Exception.Message)" -ForegroundColor Red
    }

    Write-Host ""
}

# Also try to fetch homepage for general car images
Write-Host "=== Fetching homepage: https://vinfastauto.com/vn_vi ===" -ForegroundColor Cyan
try {
    $homeFolder = Join-Path $basePath "homepage"
    if (-Not (Test-Path $homeFolder)) {
        New-Item -ItemType Directory -Path $homeFolder -Force | Out-Null
    }

    $response = Invoke-WebRequest -Uri "https://vinfastauto.com/vn_vi" -Headers $headers -TimeoutSec 30
    $html = $response.Content

    $imgMatches = [regex]::Matches($html, '(?:src|data-src|data-image|content)=["\''](https?://[^"'']+?\.(?:png|jpg|jpeg|webp))["\''?]', 'IgnoreCase')
    $imageUrls = @()
    foreach ($m in $imgMatches) {
        $url = $m.Groups[1].Value
        if ($url -match "static-cms|vinfastauto|vinfast" -and $url -notmatch "icon|logo|favicon|flag|arrow|btn|button|close") {
            $imageUrls += $url
        }
    }
    $imageUrls = $imageUrls | Select-Object -Unique
    Write-Host "  Found $($imageUrls.Count) image URLs from homepage" -ForegroundColor Green

    $i = 0
    foreach ($imgUrl in $imageUrls) {
        $i++
        $ext = [System.IO.Path]::GetExtension(($imgUrl -split '\?')[0])
        if (-not $ext -or $ext.Length -gt 6) { $ext = ".webp" }
        $fileName = "home_$i$ext"
        $filePath = Join-Path $homeFolder $fileName
        try {
            Invoke-WebRequest -Uri $imgUrl -OutFile $filePath -Headers @{
                "User-Agent" = $headers["User-Agent"]
                "Referer" = "https://vinfastauto.com/vn_vi"
            } -TimeoutSec 15
            Write-Host "  -> Saved: $filePath" -ForegroundColor Green
        } catch {
            Write-Host "  -> FAILED: $($_.Exception.Message)" -ForegroundColor Red
        }
    }
    $urlFile = Join-Path $homeFolder "urls.txt"
    $imageUrls | Out-File -FilePath $urlFile -Encoding UTF8
} catch {
    Write-Host "  FAILED: $($_.Exception.Message)" -ForegroundColor Red
}

Write-Host "`nDONE! Check folders in: $basePath" -ForegroundColor Cyan
