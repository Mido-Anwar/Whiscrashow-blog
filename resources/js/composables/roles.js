import { usePage } from "@inertiajs/vue3";
import { router } from "@inertiajs/vue3";

export function useRoles() {
    const hasRole = (role) => usePage().props.auth.user.role.includes(role);
    const hasPermission = (permission) =>
        usePage().props.auth.user.permission.includes(permission);

    const roleDestroy = (id) => {
        if (confirm("Are you sure you want to Delete")) {
            router.delete(route("role.destroy", id));
        }
    };

    const permissionDestroy = (id) => {
        if (confirm("Are you sure you want to Delete")) {
            router.delete(route("permission.destroy", id));
        }
    };
    const userDestroy = (id) => {
        if (confirm("Are you sure you want to Delete")) {
            router.delete(route("user.destroy", id));
        }
    };
    const favorite = (post) => {
        router.post(`/favorite/${post}`);
    };

    const unFavorite = (post) => {
        router.post(`/unfavorite/${post}`);
    };
    return {
        hasRole,
        hasPermission,
        roleDestroy,
        permissionDestroy,
        userDestroy,
        favorite,
        unFavorite,
    };
}
