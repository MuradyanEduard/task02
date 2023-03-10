
import { useStorage } from '@vueuse/core'

const basket = useStorage('basket', {})

export {
    basket
}