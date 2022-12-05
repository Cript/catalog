import noUiSlider from 'nouislider';

const weightSlider = document.getElementById('slider');

if (weightSlider) {
    const minField = document.getElementById('filter_weight_min');
    const maxField = document.getElementById('filter_weight_max');

    const minValue = parseInt(minField.getAttribute('min'))
    const filterMinValue = parseInt(minField.value)
    const maxValue = parseInt(maxField.getAttribute('max'))
    const filterMaxValue = parseInt(maxField.value)

    noUiSlider.create(weightSlider, {
        start: [filterMinValue, filterMaxValue],
        connect: true,
        range: {
            'min': minValue,
            'max': maxValue
        },
        tooltips: {
            to: function (numericValue) {
                if (numericValue >= 1000) {
                    return `${(numericValue / 1000).toFixed(1)} kg`
                }

                return `${numericValue.toFixed(0)} g`;
            }
        }
    });

    weightSlider.noUiSlider.on('update', function (values, handle, unencoded) {
        minField.value = unencoded[0]
        maxField.value = unencoded[1]
    });
}
