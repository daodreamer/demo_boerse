# Build frontend and push to Azure App Service
# Usage: .\push-azure.ps1

Write-Host "Building frontend..." -ForegroundColor Cyan
Set-Location frontend
npm run build
Set-Location ..

Write-Host "Copying build to public/..." -ForegroundColor Cyan
Copy-Item -Recurse -Force frontend/dist/* public/

Write-Host "Committing build artifacts..." -ForegroundColor Cyan
git add -f public/
git commit -m "deploy: frontend build artifacts" --no-verify 2>$null
if ($LASTEXITCODE -ne 0) {
    Write-Host "Nothing to commit, pushing as-is" -ForegroundColor Yellow
}

Write-Host "Pushing to Azure..." -ForegroundColor Cyan
git push azure master

Write-Host "Done! Check deployment logs in Azure Portal." -ForegroundColor Green
