<template>
  <PanelItem :index="index" :field="field" :field-name="field.name">
    <template #value>
      <span v-if="field.viewable && field.value">
        <RelationPeek
          v-if="field.peekable && field.hasFieldsToPeekAt"
          :resource-name="field.resourceName"
          :resource-id="field.morphToId"
          :resource="resource"
        >
          <Link
            @click.stop
            :href="$url(`/resources/${field.resourceName}/${field.morphToId}`)"
            class="link-default"
          >
            {{ field.resourceLabel }}: {{ field.value }}
          </Link>
        </RelationPeek>

        <Link
          v-else
          :href="$url(`/resources/${field.resourceName}/${field.morphToId}`)"
          class="link-default"
        >
          {{ field.resourceLabel }}: {{ field.value }}
        </Link>
      </span>

      <p v-else-if="field.value">
        {{ field.resourceLabel || field.morphToType }}: {{ field.value }}
      </p>
      <p v-else>&mdash;</p>
    </template>
  </PanelItem>
</template>

<script>
export default {
  props: ['index', 'resource', 'resourceName', 'resourceId', 'field'],
}
</script>
