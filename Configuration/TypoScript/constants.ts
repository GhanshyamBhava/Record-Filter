
plugin.tx_cars_fecars {
  view {
    # cat=plugin.tx_cars_fecars/file; type=string; label=Path to template root (FE)
    templateRootPath = EXT:cars/Resources/Private/Templates/
    # cat=plugin.tx_cars_fecars/file; type=string; label=Path to template partials (FE)
    partialRootPath = EXT:cars/Resources/Private/Partials/
    # cat=plugin.tx_cars_fecars/file; type=string; label=Path to template layouts (FE)
    layoutRootPath = EXT:cars/Resources/Private/Layouts/
  }
  persistence {
    # cat=plugin.tx_cars_fecars//a; type=string; label=Default storage PID
    storagePid =
  }
}
