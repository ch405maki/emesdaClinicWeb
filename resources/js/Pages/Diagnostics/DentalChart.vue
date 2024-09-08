<template>
  <div>
    <!-- Upper Teeth Section -->
    <div class="dental-chart">
      <div class="row">
        <label class="row-label text-blue-700">Operation:</label>
        <div v-for="tooth in teeth_upper" :key="tooth" class="tooth-box">
          <input 
            type="text" 
            class="tooth-input" 
            maxlength="3"
            @input="validateInput($event, 'Upper Operation', tooth)"
          />
        </div>
      </div>
      <div class="row">
        <label class="row-label text-red-700">Condition:</label>
        <div v-for="tooth in teeth_upper" :key="tooth" class="tooth-box">
          <input 
            type="text" 
            class="tooth-input" 
            maxlength="3"
            @input="validateInput($event, 'Upper Condition', tooth)"
          />
        </div>
      </div>
    </div>

    <div class="image-section mb-8">
      <img src="/images/chart/upper.png" alt="Upper Teeth Chart" class="chart-image-sub ml-[8%]" />
    </div>

    <!-- Middle Teeth Section -->
    <div class="dental-chart">
      <div class="row">
        <label class="row-label text-blue-700">Operation:</label>
        <div v-for="tooth in teethmiddleup" :key="tooth" class="tooth-box">
          <input 
            type="text" 
            class="tooth-input" 
            maxlength="3"
            @input="validateInput($event, 'Middle Operation', tooth)"
          />
        </div>
      </div>
      <div class="row">
        <label class="row-label text-red-700">Condition:</label>
        <div v-for="tooth in teethmiddleup" :key="tooth" class="tooth-box">
          <input 
            type="text" 
            class="tooth-input" 
            maxlength="3"
            @input="validateInput($event, 'Middle Condition', tooth)"
          />
        </div>
      </div>
    </div>

    <div class="image-section">
      <img src="/images/chart/chart1.jpg" alt="Middle Teeth Chart" class="chart-image ml-[5%]" />
    </div>

    <!-- Middle Bottom Teeth Section -->
    <div class="dental-chart">
      <div class="row">
        <label class="row-label text-blue-700">Operation:</label>
        <div v-for="tooth in teethmiddledown" :key="tooth" class="tooth-box">
          <input 
            type="text" 
            class="tooth-input" 
            maxlength="3"
            @input="validateInput($event, 'Middle Bottom Operation', tooth)"
          />
        </div>
      </div>
      <div class="row">
        <label class="row-label text-red-700">Condition:</label>
        <div v-for="tooth in teethmiddledown" :key="tooth" class="tooth-box">
          <input 
            type="text" 
            class="tooth-input" 
            maxlength="3"
            @input="validateInput($event, 'Middle Bottom Condition', tooth)"
          />
        </div>
      </div>
    </div>

    <div class="image-section mt-8">
      <img src="/images/chart/lower.png" alt="Lower Teeth Chart" class="chart-image-sub ml-[8%]" />
    </div>

    <!-- Lower Teeth Section -->
    <div class="dental-chart">
      <div class="row">
        <label class="row-label text-blue-700">Operation:</label>
        <div v-for="tooth in teeth_bottom" :key="tooth" class="tooth-box">
          <input 
            type="text" 
            class="tooth-input" 
            maxlength="3"
            @input="validateInput($event, 'Lower Operation', tooth)"
          />
        </div>
      </div>
      <div class="row">
        <label class="row-label text-red-700">Condition:</label>
        <div v-for="tooth in teeth_bottom" :key="tooth" class="tooth-box">
          <input 
            type="text" 
            class="tooth-input" 
            maxlength="3"
            @input="validateInput($event, 'Lower Condition', tooth)"
          />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue';

// Define arrays for teeth
const teethmiddleup = Array.from({ length: 16 }, (_, i) => i + 1);
const teethmiddledown = Array.from({ length: 16 }, (_, i) => i + 1);
const teeth_upper = Array.from({ length: 10 }, (_, i) => i + 1);
const teeth_bottom = Array.from({ length: 10 }, (_, i) => i + 1);

// Reactive data structure to store inputs
const dentalChartData = reactive({
  'Upper Operation': {},
  'Upper Condition': {},
  'Middle Operation': {},
  'Middle Condition': {},
  'Middle Bottom Operation': {},
  'Middle Bottom Condition': {},
  'Lower Operation': {},
  'Lower Condition': {},
});

// Function to validate input and store values in the reactive object
function validateInput(event, section, tooth) {
  const input = event.target.value.slice(0, 3); // Keep only the first 3 characters
  dentalChartData[section][tooth] = input; // Store the value in the data structure
  console.log(dentalChartData); // Log the structure for debugging
}
</script>

<style scoped>
/* Your styles remain unchanged */
.dental-chart {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.row {
  display: flex;
  align-items: center;
  gap: 5px;
}

.row-label {
  font-weight: bold;
  margin-right: 10px;
  width: 80px; /* Adjust the width to align with your design */
}

.tooth-box {
  display: flex;
  align-items: center;
}

.tooth-input {
  width: 40px;   /* Increased width */
  height: 40px;  /* Increased height */
  text-align: center;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 14px; /* Larger font size */
}

.chart-image {
  max-width: 75%;
  height: auto;
}

.chart-image-sub {
  max-width: 38%;
  height: auto;
}
</style>
    