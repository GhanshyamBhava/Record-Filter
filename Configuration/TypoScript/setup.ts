
plugin.tx_cars_fecars {
  view {
    templateRootPaths.0 = EXT:cars/Resources/Private/Templates/
    templateRootPaths.1 = {$plugin.tx_cars_fecars.view.templateRootPath}
    partialRootPaths.0 = EXT:cars/Resources/Private/Partials/
    partialRootPaths.1 = {$plugin.tx_cars_fecars.view.partialRootPath}
    layoutRootPaths.0 = EXT:cars/Resources/Private/Layouts/
    layoutRootPaths.1 = {$plugin.tx_cars_fecars.view.layoutRootPath}
  }
  persistence {
    storagePid = {$plugin.tx_cars_fecars.persistence.storagePid}
    #recursive = 1
  }
  features {
    #skipDefaultArguments = 1
  }
  mvc {
    #callDefaultActionIfActionCantBeResolved = 1
  }
}

plugin.tx_cars._CSS_DEFAULT_STYLE (
    
)