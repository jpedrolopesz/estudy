import { ref } from "vue"

const isEditing = ref(false)
const editingCommentId = ref(null)

export function useComment() {

  watch(() => isEditing.value, (value) => {
    if (!value) {
      editingCommentId.value = null
    }
  })

  return {
    isEditing,
    editingCommentId,
  }
}
