define([], function () {
    window.requirejs.config({
        paths: {
            "pink": M.cfg.wwwroot + '/theme/wetboew_internet/framework/cdts/pink',
            "wetboew": M.cfg.wwwroot + '/theme/wetboew_internet/framework/js/wet-boew.min',
            "theme": M.cfg.wwwroot + '/theme/wetboew_internet/framework/js/theme.min',
            "cdtscustom": M.cfg.wwwroot + '/theme/wetboew_internet/framework/cdts/cdtscustom',
        },
        shim: {
            'pink': {exports: 'pink'},
            'wetboew': {exports: 'wetboew'},
            'theme': {exports: 'theme'},
            'cdtscustom': {exports: 'cdtscustom'},
        }
    });
});