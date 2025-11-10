<template>
  <div
    class="min-h-screen bg-gray-100 py-6 flex flex-col justify-center sm:py-12"
  >
    <div class="relative py-3 sm:max-w-xl sm:mx-auto">
      <div
        class="relative px-4 py-10 bg-white shadow-lg sm:rounded-3xl sm:p-20"
      >
        <div class="max-w-md mx-auto">
          <div class="divide-y divide-gray-200">
            <div
              class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7"
            >
              <h1 class="text-3xl font-bold text-center mb-8">
                Sistema de Gestión de Incidencias
              </h1>

              <div v-if="loading" class="text-center">
                <p>Cargando...</p>
              </div>

              <div v-else-if="backendData" class="space-y-4">
                <div class="bg-green-100 p-4 rounded-lg">
                  <p class="font-semibold">✅ Backend conectado</p>
                  <p class="text-sm">{{ backendData.message }}</p>
                </div>

                <div class="bg-blue-100 p-4 rounded-lg">
                  <p class="font-semibold">📊 Estado del sistema</p>
                  <p class="text-sm">Base de datos: Conectada</p>
                  <p class="text-sm">IA (Ollama): Lista</p>
                </div>
              </div>

              <div v-else class="bg-red-100 p-4 rounded-lg">
                <p class="font-semibold">⚠️ Error de conexión</p>
                <p class="text-sm">No se pudo conectar con el backend</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";

const backendData = ref(null);
const loading = ref(true);

onMounted(async () => {
  try {
    const response = await fetch("http://localhost:8080/");
    backendData.value = await response.json();
  } catch (error) {
    console.error("Error conectando con el backend:", error);
  } finally {
    loading.value = false;
  }
});
</script>
