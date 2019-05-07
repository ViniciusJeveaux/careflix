import { Container } from '~/lib/unstated'
import axios from '~/lib/axios'
import * as cookie from 'cookie-machine'
import history from '~/lib/history'
import config from '~/config';

interface State {
  data: AppUser | null,
  token: string | null
}

class AuthContainer extends Container<State> {
  state = {
    data: null,
    token: null
  }

  isAuthenticated = (): boolean => {
    return this.state.data != null
  }

  isGuest = (): boolean => {
    return !this.isAuthenticated()
  }

  login = async (credentials: {
    username: string
    password: string
  }): Promise<AsyncGoReturn> => {
    const [err, tokenResponse] = await axios.post('/oauth/token', {
      username: credentials.username,
      password: credentials.password,
      client_id: config.api.clientId,
      client_secret: config.api.clientSecret,
      grant_type: 'password'
    })
    const token = tokenResponse.data.access_token
    cookie.set('app_token', token, {
      path: '/'
    })
    const [err2, dataResponse] = await axios.get('/api/me')
    const data = dataResponse.data
    this.setState({ data, token })
    return []
  }

  logout = () => {
    cookie.remove('app_token', {
      path: '/'
    })
    this.setState({ data: null, token: null }, () => {
      history.push('/login')
    })
  }

  getUserData = async (): Promise<AsyncGoReturn> => {
    const token: string = cookie.get('app_token') || ''

    if (!token.length) {
      return
    }

    const [err, res] = await axios.get('/api/me')

    this.setState({
      token,
      data: res.data
    })
  }

  updateUserData = (payload: Partial<AppUser>) => {
    this.setState({
      data: {
        ...this.state.data,
        ...payload
      }
    })
  }
}

export default new AuthContainer()