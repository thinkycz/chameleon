<template>
    <ol class="multisteps">
        <li v-for="(step, index) in steps"
            :key="'step-' + index"
            :class="{'visited': step.visited, 'current': step.current}">
            <a :href="step.route"
                v-if="step.visited">
                <span class="icon-wrap">
                    <component :is="step.icon"
                        v-if="step.icon"></component>
                    <span>{{ $trans(step.label) }}</span>
                </span>
            </a>
            <span v-else>
                <span class="icon-wrap">
                    <component :is="step.icon"
                        v-if="step.icon"></component>
                    <span>{{ $trans(step.label) }}</span>
                </span>
            </span>
        </li>
    </ol>
</template>
<script>
    export default {
        props: {
            steps: {
                required: true,
            },
        },
    };
</script>