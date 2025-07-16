<script setup lang="ts">
import NavFooter from '@/components/NavFooter.vue';
import NavMain from '@/components/NavMain.vue';
import NavUser from '@/components/NavUser.vue';
import { Sidebar, SidebarContent, SidebarFooter, SidebarHeader, SidebarMenu, SidebarMenuButton, SidebarMenuItem } from '@/components/ui/sidebar';
import { ParamsConsulta } from '@/Data/PaginacionLaravel';
import { MenuNegocio } from '@/Negocio/MenuNegocio';
import { type NavItem } from '@/types';
import { Link } from '@inertiajs/vue3';
import { onMounted, reactive } from 'vue';
import AppLogo from './AppLogo.vue';

const negocio: MenuNegocio = new MenuNegocio();

const footerNavItems: NavItem[] = [];

const datas = reactive({
    menus: [],
});

onMounted(() => {
    const params: ParamsConsulta = {
        query: '',
    };
    negocio
        .consultar(params)
        .then((response) => {
            console.log("api response: ");
            console.log(response);
            datas.menus = response.data;
        })
        .catch((error) => {
            console.error(error);
        });
});
</script>

<template>
    <Sidebar collapsible="icon" variant="inset">
        <SidebarHeader>
            <SidebarMenu>
                <SidebarMenuItem>
                    <SidebarMenuButton size="lg" as-child>
                        <Link :href="route('dashboard')">
                            <AppLogo />
                        </Link>
                    </SidebarMenuButton>
                </SidebarMenuItem>
            </SidebarMenu>
        </SidebarHeader>

        <SidebarContent>
            <NavMain :items="datas.menus" />
        </SidebarContent>

        <SidebarFooter>
            <NavFooter :items="footerNavItems" />
            <NavUser />
        </SidebarFooter>
    </Sidebar>
    <slot />
</template>
