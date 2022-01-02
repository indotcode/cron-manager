<template>
    <div class="ml-4 text-slate-400 text-nav flex flex-row content-center flex-wrap">
        <div class="mt-1" v-for="(item, key) in items" :key="item.name">
            <span class="mx-2" v-if="key !== 0">-</span>
            <router-link v-if="item.to" class="mt-1 hover:text-slate-700" :to="item.to">{{item.name}}</router-link>
            <span v-if="!item.to" class="mt-1">{{item.name}}</span>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Crumbs',
    props: {
        items: Array
    }
};
</script>
