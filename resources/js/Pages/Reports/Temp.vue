<div v-if="appointment.diagnostic" class="bg-white shadow rounded-lg overflow-hidden sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Diagnostic Information</h3>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
      <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Description</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic?.description || 'No diagnostic available' }}</dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Service Rendered</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic?.service_rendered || 'No Service Rendered available' }}</dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Remarks</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic?.remarks || 'No Remarks available' }}</dd>
        </div>
      </dl>
    </div>
  </div>

  <!-- Appointment Information Card -->
  <div class="bg-white shadow overflow-hidden rounded-lg sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Appointment Information</h3>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
      <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-4">
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Status</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ appointment.status }}</dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Appointment Date</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ formattedDate(appointment.appointment_date) }}</dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Occlusion</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic.occlusion }}</dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Condition</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ latestDiagnostic.condition }}</dd>
        </div>
      </dl>
    </div>
  </div>

  <!-- Odonto-stomatological Record -->
  <div class="bg-white shadow overflow-hidden rounded-lg sm:rounded-lg px-4 py-8">
  <div class="py-5">
    <h3 class="text-lg leading-6 font-medium text-gray-900">Odonto-stomatological Record</h3>
  </div>
  <!-- Upper Teeth Section -->
  <div class="dental-chart">
    <div class="row">
      <label class="text-blue-700">Operation:</label>
      <div v-for="tooth in teethUpper" :key="tooth" class="tooth-box">
        <input 
          type="text" 
          class="tooth-input"
          maxlength="3"
          :value="dentalChart['Upper Operation']?.[tooth] || ''"
          @input="validateInput($event, 'Upper Operation', tooth)"
          readonly
        />
      </div>
    </div>
    <div class="row">
      <label class="text-red-700">Condition:</label>
      <div v-for="tooth in teethUpper" :key="tooth" class="tooth-box">
        <input 
          type="text" 
          class="tooth-input"
          maxlength="3"
          :value="dentalChart['Upper Condition']?.[tooth] || ''"
          @input="validateInput($event, 'Upper Condition', tooth)"
          readonly
        />
      </div>
    </div>
  </div>

  <div class="image-section mb-8 mt-2">
    <img src="/images/chart/upper.png" alt="Upper Teeth Chart" class="chart-image-sub ml-[6%]" />
  </div>

  <!-- Middle Teeth Section -->
  <div class="dental-chart">
    <div class="row">
      <label class="text-blue-700">Operation:</label>
      <div v-for="tooth in teethMiddleUp" :key="tooth" class="tooth-box">
        <input 
          type="text" 
          class="tooth-input"
          maxlength="3"
          :value="dentalChart['Middle Operation']?.[tooth] || ''"
          @input="validateInput($event, 'Middle Operation', tooth)"
          readonly
        />
      </div>
    </div>
    <div class="row">
      <label class="text-red-700">Condition:</label>
      <div v-for="tooth in teethMiddleUp" :key="tooth" class="tooth-box">
        <input 
          type="text" 
          class="tooth-input"
          maxlength="3"
          :value="dentalChart['Middle Condition']?.[tooth] || ''"
          @input="validateInput($event, 'Middle Condition', tooth)"
          readonly
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
      <label class="text-blue-700">Operation:</label>
      <div v-for="tooth in teethMiddleDown" :key="tooth" class="tooth-box">
        <input 
          type="text" 
          class="tooth-input"
          maxlength="3"
          :value="dentalChart['Middle Bottom Operation']?.[tooth] || ''"
          @input="validateInput($event, 'Middle Bottom Operation', tooth)"
          readonly
        />
      </div>
    </div>
    <div class="row">
      <label class="text-red-700">Condition:</label>
      <div v-for="tooth in teethMiddleDown" :key="tooth" class="tooth-box">
        <input 
          type="text" 
          class="tooth-input"
          maxlength="3"
          :value="dentalChart['Middle Bottom Condition']?.[tooth] || ''"
          @input="validateInput($event, 'Middle Bottom Condition', tooth)"
          readonly
        />
      </div>
    </div>
  </div>

  <div class="image-section mt-8 mb-4">
    <img src="/images/chart/lower.png" alt="Lower Teeth Chart" class="chart-image-sub ml-[6%]" />
  </div>

  <!-- Lower Teeth Section -->
  <div class="dental-chart">
    <div class="row">
      <label class="text-blue-700">Operation:</label>
      <div v-for="tooth in teethBottom" :key="tooth" class="tooth-box">
        <input 
          type="text" 
          class="tooth-input"
          maxlength="3"
          :value="dentalChart['Lower Operation']?.[tooth] || ''"
          @input="validateInput($event, 'Lower Operation', tooth)"
          readonly
        />
      </div>
    </div>
    <div class="row">
      <label class="text-red-700">Condition:</label>
      <div v-for="tooth in teethBottom" :key="tooth" class="tooth-box">
        <input 
          type="text" 
          class="tooth-input"
          maxlength="3"
          :value="dentalChart['Lower Condition']?.[tooth] || ''"
          @input="validateInput($event, 'Lower Condition', tooth)"
          readonly
        />
      </div>
    </div>
  </div>
</div>
  <!-- Odonto-stomatological Record -->

  <!-- patient Information Card -->
  <div class="bg-white shadow overflow-hidden rounded-lg sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Patient Information</h3>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
      <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-3">
        <div class="sm:col-span-1" v-for="(value, key) in patientFields(appointment.patient)" :key="key">
          <dt class="text-sm font-medium text-gray-500">{{ key }}</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ value }}</dd>
        </div>
      </dl>
    </div>
  </div>

  <!-- Dentist Information Card -->
  <div class="bg-white shadow overflow-hidden rounded-lg sm:rounded-lg">
    <div class="px-4 py-5 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Dentist Information</h3>
    </div>
    <div class="border-t border-gray-200 px-4 py-5 sm:p-6">
      <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Name</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ appointment.dentist.name }}</dd>
        </div>
        <div class="sm:col-span-1">
          <dt class="text-sm font-medium text-gray-500">Email</dt>
          <dd class="mt-1 text-sm text-gray-900">{{ appointment.dentist.email }}</dd>
        </div>
      </dl>
    </div>
  </div>