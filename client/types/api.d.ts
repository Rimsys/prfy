
export interface MetApiResponse {
  benchmark: number
  status: 'success' | 'failure'
  query: {
    options: Record<string, any>
    params: Record<string, any>
  }
  paginate?: {
    current_page: number
    first_item: number
    last_item: number
    last_page: number
    pages: Array<number>
    per_page: number
    total: number
  }
  data: any
}
export interface Service {
  id: number
  name: string
  image_url: string
  is_available: boolean
  created_at: Date
  updated_at : Date
}

export interface User {
  name: string
  job: string
  email: string
  phone: string
  avatar: string
}

export type Users = Array<User>
export type Services = Array<Service>
