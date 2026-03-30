# Build frontend and push to Azure App Service
# Usage: .\push-azure.ps1

Write-Host ""
Write-Host "=== Azure Deployment Pre-flight Check ===" -ForegroundColor Magenta
Write-Host "Ensure the following App Settings are set in Azure Portal:" -ForegroundColor Yellow
Write-Host "  APP_ENV=prod" -ForegroundColor Gray
Write-Host "  APP_SECRET=<random-secret>" -ForegroundColor Gray
Write-Host "  DATABASE_URL=mysql://user:pass@host:3306/db?serverVersion=8.0&charset=utf8mb4" -ForegroundColor Gray
Write-Host "  PHP_EXTENSIONS=pdo_mysql intl   (or set in Azure Config)" -ForegroundColor Gray
Write-Host ""

Write-Host "Building frontend..." -ForegroundColor Cyan
Set-Location frontend
npm run build
Set-Location ..

Write-Host "Copying build to public/..." -ForegroundColor Cyan
Copy-Item -Recurse -Force frontend/dist/* public/

Write-Host "Committing build artifacts..." -ForegroundColor Cyan
git add -f public/ composer.json azure/startup.sh
git commit -m "deploy: frontend build + fix Oryx composer post-install" --no-verify 2>$null
if ($LASTEXITCODE -ne 0) {
    Write-Host "Nothing to commit, pushing as-is" -ForegroundColor Yellow
}

Write-Host "Pushing to Azure..." -ForegroundColor Cyan
git push azure master

Write-Host ""
Write-Host "Done! Monitor build: az webapp log tail --name <app-name> --resource-group <rg>" -ForegroundColor Green
