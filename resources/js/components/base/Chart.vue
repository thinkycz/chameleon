<template>
    <div ref="chart"
        class="relative pin ct-chart" />
</template>

<script>
    import Chartist from 'chartist';
    import 'chartist-plugin-tooltips';
    import 'chartist/dist/chartist.min.css';
    import 'chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css';

    export default {
        props: {
            currency: {
                required: true,
            },
            height: {
                required: true,
            },
        },

        data() {
            return {
                chart: null,
                data: {
                    // TODO:: implement real data
                    labels: ['01/01', '', '01/03', '', '01/05', ''],
                    series: [[12, 18, 10, 6, 5, 16]],
                },
            };
        },

        mounted() {
            this.chartist = new Chartist.Line(this.$refs.chart, this.data, {
                lineSmooth: Chartist.Interpolation.none(),
                fullWidth: true,
                showPoint: true,
                showLine: true,
                showArea: true,
                showLabel: true,
                height: this.height,
                chartPadding: {
                    top: 10,
                    right: 5,
                    bottom: 0,
                    left: 5,
                },
                low: 0,
                axisX: {
                    showLabel: true,
                },
                axisY: {
                    showLabel: false,
                    offset: 0,
                },
                plugins: [
                    Chartist.plugins.tooltip({
                        anchorToPoint: true,
                        transformTooltipTextFnc: value => {
                            if (this.currency.symbol_is_before) {
                                return `${this.currency.symbol}${value}`;
                            }
                            return `${value}${this.currency.symbol}`;
                        },
                    }),
                ],
            });
        },
    };
</script>