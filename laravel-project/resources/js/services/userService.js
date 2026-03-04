import axios from 'axios'

// Since Vue frontend and Laravel backend are now in the same project,
// we can use relative API URLs
const apiClient = axios.create({
  baseURL: '/api',
  headers: {
    Accept: 'application/json',
  },
})

// helper conversions
function toSnake(obj) {
  return {
    first_name: obj.firstName,
    last_name: obj.lastName,
    age: obj.age,
    department: obj.department,
    city: obj.city,
  }
}

function toCamel(obj) {
  return {
    id: obj.id,
    firstName: obj.first_name,
    lastName: obj.last_name,
    age: obj.age,
    department: obj.department,
    city: obj.city,
  }
}

export default {
  getUsers(params = {}) {
    return apiClient.get('/users', { params }).then((res) => {
      // Laravel paginator returns data under `data` key
      if (res.data && Array.isArray(res.data.data)) {
        res.data.data = res.data.data.map(toCamel)
      }
      return res
    })
  },

  getFilterOptions() {
    return apiClient.get('/users/filters').then(res => res.data)
  },

  createUser(user) {
    return apiClient.post('/users', toSnake(user))
  },

  updateUser(id, user) {
    return apiClient.put(`/users/${id}`, toSnake(user))
  },

  deleteUser(id) {
    return apiClient.delete(`/users/${id}`)
  },
}
