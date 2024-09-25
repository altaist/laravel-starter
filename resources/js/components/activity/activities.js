import { requestPost } from '@/utils/requests'

export const sendAction = (taskId, actionData) => {
    return requestPost(route('action.create', {taskId}), {
        action_data: actionData
    });
}


