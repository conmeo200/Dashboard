<template>
    <div v-if="isVisible" class="modal-overlay" @click="close">
      <div class="modal-content" @click.stop>
        <button class="close-button" @click="close">X</button>
        <slot></slot>
      </div>
    </div>
  </template>

  <script>
  export default {
    name: "Modal",
    props: {
      isVisible: {
        type: Boolean,
        default: false,
      }
    },
    methods: {
      close() {
        this.$emit('close');
      }
    }
  };
  </script>

  <style scoped>
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
  }

  .modal-content {
    background-color: white;
    padding: 20px;
    border-radius: 5px;
    width: 400px;
    max-width: 100%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
  }

  .close-button {
    background: none;
    border: none;
    font-size: 16px;
    position: absolute;
    top: 10px;
    right: 10px;
    cursor: pointer;
  }
  </style>
