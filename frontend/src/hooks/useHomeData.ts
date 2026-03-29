import { useState, useEffect } from 'react'
import type { HomeData } from '../types/api'

interface UseHomeDataResult {
  data: HomeData | null
  loading: boolean
  error: string | null
}

export function useHomeData(): UseHomeDataResult {
  const [data, setData] = useState<HomeData | null>(null)
  const [loading, setLoading] = useState(true)
  const [error, setError] = useState<string | null>(null)

  useEffect(() => {
    fetch('/api/home')
      .then((r) => {
        if (!r.ok) throw new Error(`HTTP ${r.status}`)
        return r.json() as Promise<HomeData>
      })
      .then(setData)
      .catch((e: Error) => setError(e.message))
      .finally(() => setLoading(false))
  }, [])

  return { data, loading, error }
}
