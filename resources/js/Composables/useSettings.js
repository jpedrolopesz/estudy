import { ref } from "vue"

const isOpen = ref(false)
const teamModalOpen = ref(false)

export function useSettings() {
  return {
    isOpen,
    teamModalOpen,
  }
}
