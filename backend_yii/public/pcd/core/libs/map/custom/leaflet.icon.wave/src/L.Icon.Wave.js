(function (window) {
    L.Icon.Wave = L.DivIcon.extend({

        options: {
            className: '',
            style: '',

            // color: '#057CFF',
            iconAnchor: [0, 0],
            iconSize: [16, 16],
            iconEffect: 'bounce', // bounce, scale
            bgPin: '#057cff',
            bdPin: '2px solid white',

            waveSize: [80, 80],
            bgWave: 'rgba(5, 124, 255, 0.6)',
            bdWave: '',
            bxshWave: '', // 0 0 6px 3px ${bgWave};
            trfWave: '', // rotateX(55deg);

            animate: true,
            heartbeat: 1,
        },

        initialize: function (options) {
            L.setOptions(this, options);

            const {style, iconEffect, animate, bgPin, bdPin, trfWave, bdWave, bxshWave, heartbeat, color, bgWave, iconSize, iconAnchor, waveSize} = this.options;

            if (style) {
                L.DivIcon.prototype.initialize.call(this, this.getStyle(options.style));
                return;
            }



            var uniqueClassName = 'lpi-' + new Date().getTime() + '-' + Math.round(Math.random() * 100000);

            var pin = [
                `background: ${bgPin}`,
                `width: ${iconSize[0]}px;`,
                `height: ${iconSize[1]}px;`,
                `top: ${-iconSize[0] / 2 }px;`,
                `left: ${-iconSize[1] / 2}px;`,
            ];
            !bdPin || pin.push(`border: ${bdPin}`);

            switch (iconEffect) {
                case 'bounce':
                    pin.push([
                        `animation-name: bounce;
                             animation-fill-mode: both;
                             animation-duration: 1s;`
                    ]);
                    break;
                case 'scale':
                    pin.push([
                        `animation: scale linear 0.5s;
                             transform-origin: 50% 50%;
                             animation-fill-mode: forwards;
                             animation-iteration-count: 1;`
                    ]);
                default:
                    break;
            }


            var pin_wave = [];
            !trfWave || pin_wave.push(`transform: ${trfWave};`);

            var pin_wave_after = [
                `width: ${waveSize[0]}px;`,
                `height: ${waveSize[1]}px;`,
                `top: ${-waveSize[0] / 2 - (bdWave ? parseInt(bdWave) : 0)}px;`,
                `left: ${-waveSize[1] / 2 - (bdWave ? parseInt(bdWave) : 0)}px;`,

                `animation: pulsate ${heartbeat}s ease-out infinite;`,
                `animation-delay: ${heartbeat + .1}s;`,
            ];
            !bgWave || pin_wave_after.push(`background: ${bgWave};`);
            !bdWave || pin_wave_after.push(`border: ${bdWave};`);
            !bxshWave || pin_wave_after.push(`box-shadow: ${bxshWave};`);


            if (!animate) {
                pin_wave_after.push('animation: none');
            }

            var css = [
                `.${uniqueClassName} { ${pin.join(';')}; }`,
                `.${uniqueClassName}-wave { ${pin_wave.join(';')}; }`,
                `.${uniqueClassName}-wave::after { ${pin_wave_after.join(';')}; }`,
            ].join('');

            var el = document.createElement('style');


            if (el.styleSheet) {
                el.styleSheet.cssText = css;

            } else {
                el.appendChild(document.createTextNode(css));
            }

            document.getElementsByTagName('head')[0].appendChild(el);

            this.options.html = ` <!--<div class="shadow"></div>--> <div class="pin ${uniqueClassName}"></div><div class="pin-wave ${uniqueClassName}-wave"></div>`;

            L.DivIcon.prototype.initialize.call(this, options);
        },

        getStyle(style) {
            switch (style) {
                case '01':
                    return {
                        iconAnchor: [2, 2],
                        popupAnchor: [-1, -3],
                        html: ' <div class="geodot"></div> <div class="geodot-wave"></div> <div class="geodot-wave2"></div>'
                    }
                    break;
                case '02':
                    return {
                        iconAnchor: [3, 25],
                        popupAnchor: [0, -30],

                        html: `<div class='pin02 bounce'></div> <div class='pulse'></div>`
                    }
                    break;

            }
        }
    });

    L.icon.wave = function (options) {
        return new L.Icon.Wave(options);
    };


    L.Marker.Wave = L.Marker.extend({
        initialize: function (latlng, options) {
            options.icon = L.icon.pulse(options);
            L.Marker.prototype.initialize.call(this, latlng, options);
        }
    });

    L.marker.wave = function (latlng, options) {
        return new L.Marker.Wave(latlng, options);
    };
})(window);