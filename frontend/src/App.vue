<template>
    <div id="app">
        <TopNavigation />
        <div class="container mx-auto">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import TopNavigation from '@/components/TopNavigation';
export default {
    components: {
        TopNavigation,
    },
    data() {
        return {};
    },
};
</script>

<style>
</style>
