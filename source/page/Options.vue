<template>
    <div>
        <div class="flex flex-row mb-2 justify-between content-center flex-wrap">
            <div class="mb-3 flex flex-row content-center flex-wrap">
                <h2 class="text-2xl">Настройки</h2>
                <Crumbs :items="[{to: '/', name: 'Главная'}, {name: 'Настройки'}]"/>
            </div>
        </div>
    </div>
</template>

<script>
import Crumbs from './../components/Crumbs'
export default {
    name: 'PageOptions',
    components: {Crumbs},
    data: () => {
        return {

        }
    }
};
</script>

<style>

</style>
