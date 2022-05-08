<template>
  <app-layout title="Profile">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Upload Inventory Movements
      </h2>
    </template>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <!-- TODO: remove user from prop -->
        <upload-inventory-movement-form :user="$page.props.user" />
      </div>
    </div>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import UploadInventoryMovementForm from "@/Pages/InventoryMovement/Partials/UploadInventoryMovementForm.vue";

export default defineComponent({
  components: {
    AppLayout,
    UploadInventoryMovementForm,
  },
});
</script>
