# atvp.org

The wp-content directory for Alternatives to Violence on the Palouse

## Project setup

### Install plugins not in this repository

* `wp plugin install sg-cachepress`
  * Not necessary for local development.

## Deployments

### develop branch

With every push to the `develop` branch, the GitHub action in `.github/workflows/deploy-develop.yml` will run and deploy the contents of this repository to the configured development environment.

Deployment is performed through `rsync`. Any files or patterns listed in the repository's `.deploy_ignore` file are not be included in the deployment. Files that do not exist in this repository will be deleted from the development environment.
